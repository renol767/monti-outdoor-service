document.addEventListener('DOMContentLoaded', function() {
    // Listen for change events on all file inputs within the admin settings form
    // or generally any file input that has a preceding sibling which is an image container
    document.addEventListener('change', function(e) {
        if (e.target.matches('input[type="file"]')) {
            const input = e.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Try to find an existing preview image associated with this input
                    // Strategy 1: Previous sibling container
                    let previewContainer = input.previousElementSibling;
                    let img = null;

                    // Check if previous element is the preview div (has 'mb-2' class or contains img)
                    if (previewContainer && (previewContainer.classList.contains('mb-2') || previewContainer.querySelector('img'))) {
                        img = previewContainer.querySelector('img');
                    }
                    
                    if (img) {
                        img.src = e.target.result;
                    } else {
                        // Create a new preview container if it doesn't exist
                        const newContainer = document.createElement('div');
                        newContainer.className = 'mb-2';
                        // Add some default styling to match existing blade
                        newContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="d-block rounded" style="max-height: 80px; width: auto; background: #eee; padding: 5px;">`;
                        input.parentNode.insertBefore(newContainer, input);
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    });

    console.log('Admin Preview Handler loaded');
});
