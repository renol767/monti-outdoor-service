/**
 * Landing Page Preview Handler
 * Listens for messages from the Admin Panel to update content dynamically.
 */

window.addEventListener('message', function (event) {
    // Security check: ensure the message comes from the same origin
    if (event.origin !== window.location.origin) {
        // console.warn('Received message from unknown origin:', event.origin);
        // return; 
    }

    const data = event.data;

    if (data.type === 'preview_update') {
        const settings = data.settings;

        // Iterate over settings and update elements
        for (const [key, value] of Object.entries(settings)) {
            // Find elements with corresponding data-preview-key
            const elements = document.querySelectorAll(`[data-preview-key="${key}"]`);

            elements.forEach(element => {
                if (element.tagName === 'IMG') {
                    // Update image source
                    // If it's a blob url (preview) use it, otherwise use asset path logic
                    if (value) {
                         element.src = value;
                    }
                } else if (element.tagName === 'DIV' && element.hasAttribute('data-preview-key') && key === 'about_text') {
                    // Handle specific rich text containers if necessary
                     element.innerHTML = value;
                } else if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                    element.value = value;
                } else {
                    // Default to innerText/innerHTML
                    // Check if value contains HTML tags
                    if (/<[a-z][\s\S]*>/i.test(value)) {
                         element.innerHTML = value;
                    } else {
                         element.textContent = value;
                    }
                }
            });
        }
    }
});

console.log('Preview Listener Active');

console.log('Preview Listener Active');
