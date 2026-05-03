const scriptURL = 'https://script.google.com/macros/s/AKfycbwdtRWdZsZBbdfJAJ0Nb4kC6jOgUsdBqBivYgknSfp8X8xua_3YEOD4u8V6Yman4uQ8rg/exec';
    const form = document.forms['google-sheet'];
    const btn = document.getElementById('submitButton');

    if (form) {
        form.addEventListener('submit', e => {
            e.preventDefault();
            
            btn.innerText = "Sending...";
            btn.disabled = true;

            fetch(scriptURL, { method: 'POST', body: new FormData(form)})
                .then(response => {
                    alert("Success! Your registration is complete.");
                    form.reset(); 
                    btn.innerText = "Sign Up Now";
                    btn.disabled = false;
                })
                .catch(error => {
                    console.error('Error!', error.message);
                    alert("Error! Please check your internet connection.");
                    btn.innerText = "Sign Up Now";
                    btn.disabled = false;
                });
        });
    }

    const newsletterScriptURL = 'https://script.google.com/macros/s/AKfycbwdtRWdZsZBbdfJAJ0Nb4kC6jOgUsdBqBivYgknSfp8X8xua_3YEOD4u8V6Yman4uQ8rg/exec';
    const newsForm = document.getElementById('newsletterForm');

    if (newsForm) {
        newsForm.addEventListener('submit', e => {
            e.preventDefault();
            
            const btn = newsForm.querySelector('button');
            const originalText = btn.innerText;
            
            btn.innerText = "Joining...";
            btn.disabled = true;

            fetch(newsletterScriptURL, { method: 'POST', body: new FormData(newsForm)})
                .then(response => {
                    alert("Thanks for subscribing to our newsletter!");
                    newsForm.reset(); 
                    btn.innerText = originalText;
                    btn.disabled = false;
                })
                .catch(error => {
                    console.error('Error!', error.message);
                    alert("Error subscribing. Please try again.");
                    btn.innerText = originalText;
                    btn.disabled = false;
                });
        });
    }