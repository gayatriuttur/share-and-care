const tBtn = document.getElementById('toggle-details');
const profileDetails = document.querySelector('.card-details');

tBtn.addEventListener('click', () => {
    profileDetails.classList.toggle('show-details');
    const icon = tBtn.querySelector('i');
    icon.classList.toggle('fa-chevron-down');
    icon.classList.toggle('fa-chevron-up');
});
