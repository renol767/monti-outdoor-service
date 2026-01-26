import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

console.log('Image Cropper module loaded');

document.addEventListener('DOMContentLoaded', function () {
    if (!window.bootstrap) {
        console.error('Bootstrap 5 is not loaded. Image Cropper requires Bootstrap.');
        return;
    }
    // Inject Modal HTML into the body
    const modalHtml = `
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container" style="max-height: 500px;">
                        <img id="imageToCrop" src="" style="max-width: 100%; display: block;" alt="Picture">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropAndSave">Crop & Save</button>
                </div>
            </div>
        </div>
    </div>`;
    document.body.insertAdjacentHTML('beforeend', modalHtml);

    let cropper;
    const cropModal = new window.bootstrap.Modal(document.getElementById('cropModal'));
    const imageToCrop = document.getElementById('imageToCrop');
    let currentInputId = null;
    let aspectRatio = NaN; // Default to free
    let originalMimeType = 'image/png'; // Default fallback

    // Listen for changes on file inputs with class 'crop-image'
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('crop-image') || e.target.closest('.crop-image-input')) {
             const input = e.target.classList.contains('crop-image') ? e.target : e.target.closest('.crop-image-input');
             if (!input || !input.files || !input.files.length) return;

             const file = input.files[0];

             // Prevent loop: if the file is our cropped output, ignore
             if (file.name === 'cropped_image.png' || file.name.startsWith('cropped_image.')) {
                 return;
             }
             
             // Check file type
             if (!file.type.startsWith('image/')) {
                 alert('Please upload an image file.');
                 return;
             }
             
             // Store original MIME type
             originalMimeType = file.type;
             console.log('Original MIME Type captured:', originalMimeType);

             // Check file size (Initial check, can be looser than server)
             // 15MB limit for pre-crop
             if (file.size > 50 * 1024 * 1024) { // Updated to 50MB per user request context
                 alert('Please upload an image smaller than 50MB.');
                 input.value = '';
                 return;
             }

             currentInputId = input.id || input.name; // Fallback to name if ID missing
             console.log('Current Input ID set to:', currentInputId);
             
             // Determine Aspect Ratio from data attribute
             // data-ratio="16/9" or data-ratio="1" or data-ratio="free"
             const ratioAttr = input.getAttribute('data-ratio');
             if (ratioAttr === 'free' || !ratioAttr) {
                 aspectRatio = NaN;
             } else {
                 try {
                     const parts = ratioAttr.split('/');
                     if(parts.length === 2) {
                        aspectRatio = parseFloat(parts[0]) / parseFloat(parts[1]);
                     } else {
                        aspectRatio = parseFloat(ratioAttr);
                     }
                 } catch (err) {
                     aspectRatio = NaN;
                 }
             }

             const reader = new FileReader();
             reader.onload = function (e) {
                 imageToCrop.src = e.target.result;
                 cropModal.show();
             };
             reader.readAsDataURL(file);
             input.value = ''; // Reset input so same file can be selected again if cancelled
        }
    });

    const modalElement = document.getElementById('cropModal');
    
    modalElement.addEventListener('shown.bs.modal', function () {
        cropper = new Cropper(imageToCrop, {
            aspectRatio: aspectRatio,
            viewMode: 1, // Restrict crop box to canvas
            autoCropArea: 1,
        });
    });

    modalElement.addEventListener('hidden.bs.modal', function () {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    });

    document.getElementById('cropAndSave').addEventListener('click', function () {
        console.log('Crop & Save clicked');
        if (!cropper) {
            console.error('Cropper instance is null');
            return;
        }

        // Find the input element again (by ID is safest, requires inputs to have IDs)
        let inputElement = document.getElementById(currentInputId);
        if(!inputElement) {
            // Try finding by name if ID failed (less reliable if multiple inputs have same name)
            inputElement = document.querySelector(`input[name="${currentInputId}"]`);
        }
        console.log('Target Input Element:', inputElement);

        // Check if we should disable resizing (for Hero Slides/Quote)
        const noResize = inputElement && inputElement.getAttribute('data-no-resize') === 'true';
        console.log('No Resize Mode:', noResize);

        let cropOptions = {
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
            fillColor: 'transparent',
        };

        // If no-resize is requested, don't set width/height limits
        // This will crop at full resolution of the source image
        if (!noResize) {
            cropOptions.width = 1200;
            cropOptions.height = 1200;
            cropOptions.minWidth = 256;
            cropOptions.minHeight = 256;
        }

        // Get cropped canvas
        console.log('Generating canvas...');
        const canvas = cropper.getCroppedCanvas(cropOptions);
        
        if (!canvas) {
            console.error('Failed to generate canvas');
            return;
        }

        console.log('Converting canvas to blob with type:', originalMimeType);
        canvas.toBlob(function (blob) {
            if (!blob) {
                console.error('Blob creation failed');
                return;
            }
            console.log('Blob created:', blob.size, blob.type);

            // Determine extension based on MIME type
            let ext = 'png';
            if (originalMimeType === 'image/jpeg') ext = 'jpg';
            if (originalMimeType === 'image/webp') ext = 'webp';
            
            const fileName = `cropped_image.${ext}`;
            const file = new File([blob], fileName, { type: originalMimeType });

            // Find the input element again (by ID is safest, requires inputs to have IDs)
            let input = document.getElementById(currentInputId);
            if(!input) {
                // Try finding by name if ID failed (less reliable if multiple inputs have same name)
                input = document.querySelector(`input[name="${currentInputId}"]`);
            }
            
            if (input) {
                // Create a DataTransfer to set the file input files
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;
                
                // Trigger change event manually so previews/other listeners pick it up
                const event = new Event('change', { bubbles: true });
                input.dispatchEvent(event);
                console.log('Input updated and change event dispatched');
            } else {
                console.error('Input element not updated - failed to find input');
            }

            cropModal.hide();
        }, originalMimeType, 0.9); // Use original MIME type
    });
});
