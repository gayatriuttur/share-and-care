// Sample donation data (replace with backend fetch)
const donations = [
    { id: 1, item: 'Clothes (5 shirts)', date: '2026-02-10', status: 'accepted', org: 'Local Shelter' },
    { id: 2, item: 'Food (10kg rice)', date: '2026-02-05', status: 'pending', org: 'Food Bank' },
    { id: 3, item: 'Books (20 pcs)', date: '2026-01-28', status: 'accepted', org: 'School Aid' }
];

let displayedDonations = 0;
const perPage = 3;

// Populate donations
function renderDonations() {
    const list = document.getElementById('donationList');
    list.innerHTML = '';
    donations.slice(0, displayedDonations + perPage).forEach(donation => {
        const li = document.createElement('li');
        li.className = `donation-item ${donation.status}`;
        li.innerHTML = `
            <div class="item-details">
                <h4>${donation.item}</h4>
                <div class="item-meta">${donation.date} • ${donation.org}</div>
            </div>
            <span><i class="fas ${donation.status === 'accepted' ? 'fa-check-circle' : 'fa-clock'}"></i></span>
        `;
        list.appendChild(li);
    });
