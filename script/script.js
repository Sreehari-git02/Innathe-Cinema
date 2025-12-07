
const modalOverlay = document.getElementById('modalOverlay');
const openSignIn = document.getElementById('openSignIn');
const openSignUp = document.getElementById('openSignUp');
const closeModal = document.getElementById('closeModal');

const tabSignIn = document.getElementById('tabSignIn');
const tabSignUp = document.getElementById('tabSignUp');

const signInForm = document.getElementById('signInForm');
const signUpForm = document.getElementById('signUpForm');

const switchToSignUp = document.getElementById('switchToSignUp');
const switchToSignIn = document.getElementById('switchToSignIn');

function openModal() {
    modalOverlay.classList.add('showModal');
}

function closeAuthModal() {
    modalOverlay.classList.remove('showModal');
}


// Show Sign In tab
function showSignIn() {
    tabSignIn.classList.add('activeTab');
    tabSignUp.classList.remove('activeTab');
    signInForm.classList.remove('hiddenForm');
    signUpForm.classList.add('hiddenForm');
}

// Show Sign Up tab
function showSignUp() {
    tabSignUp.classList.add('activeTab');
    tabSignIn.classList.remove('activeTab');
    signUpForm.classList.remove('hiddenForm');
    signInForm.classList.add('hiddenForm');
}

// Navbar buttons
openSignIn.addEventListener('click', (e) => {
    e.preventDefault();
    showSignIn();
    openModal();
});

openSignUp.addEventListener('click', (e) => {
    e.preventDefault();
    showSignUp();
    openModal();
});

// Close button
closeModal.addEventListener('click', closeAuthModal);

// Click outside modal
modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) {
        closeAuthModal();
    }
});

// ESC key closes modal
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAuthModal();
});

// Tab buttons
tabSignIn.addEventListener('click', showSignIn);
tabSignUp.addEventListener('click', showSignUp);

// Inline switch links
switchToSignUp.addEventListener('click', (e) => {
    e.preventDefault();
    showSignUp();
});

switchToSignIn.addEventListener('click', (e) => {
    e.preventDefault();
    showSignIn();
});


