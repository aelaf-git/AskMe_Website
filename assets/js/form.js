const scriptURL = 'https://script.google.com/macros/s/AKfycbwdtRWdZsZBbdfJAJ0Nb4kC6jOgUsdBqBivYgknSfp8X8xua_3YEOD4u8V6Yman4uQ8rg/exec';

// Registration Form Handler
const regForm = document.getElementById('registrationform');
const regBtn = document.getElementById('submitButton');

if (regForm) {
    regForm.addEventListener('submit', e => {
        e.preventDefault();
        regBtn.innerText = "Sending...";
        regBtn.disabled = true;

        fetch(scriptURL, { method: 'POST', body: new FormData(regForm)})
            .then(response => {
                alert("Success! Your registration is complete.");
                regForm.reset(); 
                regBtn.innerText = "Sign Up Now";
                regBtn.disabled = false;
            })
            .catch(error => {
                console.error('Error!', error.message);
                alert("Error! Please check your internet connection.");
                regBtn.innerText = "Sign Up Now";
                regBtn.disabled = false;
            });
    });
}

// Newsletter Form Handler
const newsForm = document.getElementById('newsletterForm');
if (newsForm) {
    newsForm.addEventListener('submit', e => {
        e.preventDefault();
        const btn = newsForm.querySelector('button');
        const originalText = btn.innerText;
        btn.innerText = "Joining...";
        btn.disabled = true;

        fetch(scriptURL, { method: 'POST', body: new FormData(newsForm)})
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

// Contact Form Handler
const contactForm = document.getElementById('contactForm');
const contactBtn = document.getElementById('sendMessageButton');

if (contactForm) {
    contactForm.addEventListener('submit', e => {
        e.preventDefault();
        contactBtn.innerText = "Sending Message...";
        contactBtn.disabled = true;

        const formData = new FormData(contactForm);
        
        fetch('assets/mail/contact.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                alert("Your message has been sent successfully!");
                contactForm.reset();
            } else {
                throw new Error('Server response was not ok.');
            }
        })
        .catch(error => {
            console.error('Error!', error.message);
            alert("Sorry, it seems our mail server is not responding. Please try again later.");
        })
        .finally(() => {
            contactBtn.innerText = "Send Message";
            contactBtn.disabled = false;
        });
    });
}