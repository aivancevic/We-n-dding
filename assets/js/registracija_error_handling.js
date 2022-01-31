    const lastName = document.querySelector('[name="korisnik"]')
    const firstName = document.querySelector('[name="ime"]')
    const form = document.querySelector('.register-form');
    const action = form.action;

    const checkUsername = () => {
    
        let valid = false;
    
        const min = 3,
            max = 25;
    
        const username = document.querySelector('[name="uid"]').value.trim();
    
        if (!isRequired(username)) {
            showError(document.querySelector('[name="uid"]'), 'Korisničko ime ne smije biti prazno.');
        } else if (!isBetween(username.length, min, max)) {
            showError(document.querySelector('[name="uid"]'), `'Korisničko ime mora biti između ${min} i ${max} znaka.`)
        } else {
            showSuccess(document.querySelector('[name="uid"]'));
            valid = true;
        }
        return valid;
    };
   
   
    const checkEmail = () => {
        let valid = false;
        const email = document.querySelector('[name="email"]').value.trim();
        if (!isRequired(email)) {
            showError(document.querySelector('[name="email"]'), 'Email ne smije biti prazan');
        } else if (!isEmailValid(email)) {
            showError(document.querySelector('[name="email"]'), 'Email nije u prihvatljivom formatu.')
        } else {
            showSuccess(document.querySelector('[name="email"]'));
            valid = true;
        }
        return valid;
    };
    
    const checkPassword = () => {
        let valid = false;
    
    
        const password = document.querySelector('[name="pwd"]').value.trim();
    
        if (!isRequired(password)) {
            showError(document.querySelector('[name="pwd"]'), 'Lozinka ne smije biti prazna');
        } else if (!isPasswordSecure(password)) {
            showError(document.querySelector('[name="pwd"]'), 'Lozinka mora imati bar 4 znaka od kojih 1 mora biti broj');
        } else {
            showSuccess(document.querySelector('[name="pwd"]'));
            valid = true;
        }
    
        return valid;
    };
    
    const checkConfirmPassword = () => {
        let valid = false;
        // check confirm password
        const confirmPassword = document.querySelector('[name="pwdrepeat"]').value.trim();
        const password = document.querySelector('[name="pwd"]').value.trim();
    
        if (!isRequired(confirmPassword)) {
            showError(document.querySelector('[name="pwdrepeat"]'), 'Molimo ponovno unesite lozinku');
        } else if (password !== confirmPassword) {
            showError(document.querySelector('[name="pwdrepeat"]'), 'Lozinka se ne podudara');
        } else {
            showSuccess(document.querySelector('[name="pwdrepeat"]'));
            valid = true;
        }
    
        return valid;
    };
    
    const isEmailValid = (email) => {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };
    
    const isPasswordSecure = (password) => {
        // const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        const re = new RegExp("^(?=.{4,})(?=.*[0-9])");
        return re.test(password);
    };
    
    const isRequired = value => value === '' ? false : true;
    const isBetween = (length, min, max) => length < min || length > max ? false : true;
    
    
    const showError = (input, message) => {
        // get the form-field element
        const formField = document.querySelector('.register-error-small');
        // add the error class
        const errorOutput = document.querySelector(".register-error-small");
        formField.classList.remove('success');
        formField.classList.add('error');
    
        // show the error message
        const error = document.querySelector('.register-error-small');
        error.textContent = message;
    
    };
    
    const showSuccess = (input) => {
        // get the form-field element
        const formField = input.parentElement;
    
        // remove the error class
        formField.classList.remove('error');
        formField.classList.add('success');
    
        // hide the error message
        const error = document.querySelector('.register-error-small');
        error.textContent = '';
    }
    
    document.querySelector('[type="submit"]').addEventListener('click', function(e) {
        // prevent the form from submitting
       // e.preventDefault();
        
        form.action ="";
        
        document.querySelector('.register-form').action="";
    
        
        // validate fields
        // form.action=action;
        let isUsernameValid = checkUsername(),
        isEmailValid = checkEmail(),
        isPasswordValid = checkPassword(),
        isConfirmPasswordValid = checkConfirmPassword();
    
        let isFormValid = isUsernameValid &&
        isEmailValid &&
        isPasswordValid &&
        isConfirmPasswordValid;
    
        if(document.querySelector(".register-error-small").innerText!==""){
            isFormValid=false;
            }
        if (isFormValid) {
           form.action=action;
        }
    });
    
    
    const debounce = (fn, delay = 520) => {
        let timeoutId;
        return (...args) => {
            // cancel the previous timer
            if (timeoutId) {
                clearTimeout(timeoutId);
            }
            // setup a new timer
            timeoutId = setTimeout(() => {
                fn.apply(null, args)
            }, delay);
        };
    };
    
    form.addEventListener('input', debounce(function(e) {
        imePrezimeCapital("ime","prez")
        switch (e.target.name) {
            case 'uid':
                checkUsername();
                break;
            case 'email':
                checkEmail();
                break;
            case 'pwd':
                checkPassword();
                break;
            case 'pwdrepeat':
                checkConfirmPassword();
                break;
        }
    }));
    
function imePrezimeCapital(...array) {
    array.forEach(element => {
        if(element){
            document.querySelector(`[name="${element}"]`).value=document.querySelector(`[name="${element}"]`).value.charAt(0).toUpperCase()+document.querySelector(`[name="${element}"]`).value.slice(1)
        }
       
    });
}
