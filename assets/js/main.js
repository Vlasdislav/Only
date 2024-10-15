const editPasswordBtn = document.querySelector(".edit-password-btn");
const editPasswordForm = document.querySelector(".edit-password-form");

editPasswordBtn.addEventListener('click', () => {
    editPasswordForm.classList.toggle('active');
});
