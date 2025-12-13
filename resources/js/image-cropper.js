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

    // Listen for changes on file inputs with class 'crop-image'
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('crop-image') || e.target.closest('.crop-image-input')) {
             const input = e.target.classList.contains('crop-image') ? e.target : e.target.closest('.crop-image-input');
             if (!input || !input.files || !input.files.length) return;

             const file = input.files[0];

             // Prevent loop: if the file is our cropped output, ignore
             if (file.name === 'cropped_image.png') {
                 return;
             }
             
             // Check file type
             if (!file.type.startsWith('image/')) {
                 alert('Please upload an image file.');
                 return;
             }

             // Check file size (Initial check, can be looser than server)
             // 15MB limit for pre-crop
             if (file.size > 15 * 1024 * 1024) {
                 alert('Please upload an image smaller than 10MB.');
                 input.value = '';
                 return;
             }

             currentInputId = input.id || input.name; // Fallback to name if ID missing
             
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
        if (!cropper) return;

        // Get cropped canvas
        // Use decent dimensions for quality
        const canvas = cropper.getCroppedCanvas({
            width: 1200, // Max width, will scale down if needed or up if small
            height: 1200, // Max height
            minWidth: 256,
            minHeight: 256,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
            fillColor: 'transparent', // Ensure transparency
        });

        canvas.toBlob(function (blob) {
            // Create a new File object from the blob - Use PNG for transparency support
            const fileName = 'cropped_image.png';
            const file = new File([blob], fileName, { type: 'image/png' });

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
            }

            cropModal.hide();
        }, 'image/png'); // PNG format
    });
});
