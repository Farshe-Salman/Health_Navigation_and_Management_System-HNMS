document.addEventListener('DOMContentLoaded', function() {
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    const contentDiv = document.getElementById('content');

    function loadContent(page) {
        fetch(`${page}.php`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                contentDiv.innerHTML = data;
                // If the loaded content is the hospitals page, re-attach event listeners for delete
                if (page === 'adminHospitals') {
                    attachDeleteEventListeners();
                    attachSearchEventListener();
                } else if (page === 'adminDoctors') {
                    attachDoctorDeleteEventListeners();
                    attachDoctorSearchEventListener();
                    attachDoctorViewEventListeners();
                } else if (page === 'adminUserApproval') {
                    attachUserApprovalEventListeners();
                }
            })
            .catch(error => {
                console.error('Error loading page:', error);
                contentDiv.innerHTML = `<p>Error loading content. Please check the console.</p>`;
            });
    }

    function attachUserApprovalEventListeners() {
        const approveButtons = document.querySelectorAll('.btn-approve');
        const rejectButtons = document.querySelectorAll('.btn-reject');

        const handleStatusUpdate = (username, status) => {
            if (!confirm(`Are you sure you want to ${status} this user?`)) return;

            fetch(`../controller/adminUserApprovalController.php?action=update_status&username=${username}&status=${status}`)
                .then(response => {
                    if (response.ok) {
                        loadContent('adminUserApproval');
                    } else {
                        alert(`Error: Could not ${status} user.`);
                    }
                })
                .catch(error => console.error('Status update error:', error));
        };

        approveButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const username = this.getAttribute('data-username');
                handleStatusUpdate(username, 'approved');
            });
        });

        rejectButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const username = this.getAttribute('data-username');
                handleStatusUpdate(username, 'rejected');
            });
        });
    }

    function attachDoctorViewEventListeners() {
        const viewButtons = document.querySelectorAll('.view-btn-doctor');
        const modal = document.getElementById('doctorModal');
        const closeBtn = document.querySelector('#doctorModal .close-btn');
        const detailsContent = document.getElementById('doctorDetailsContent');

        viewButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const doctorData = JSON.parse(this.getAttribute('data-doctor'));
                
                let content = '';
                for (const [key, value] of Object.entries(doctorData)) {
                    content += `<p><strong>${key.replace(/_/g, ' ').toUpperCase()}:</strong> ${value}</p>`;
                }
                detailsContent.innerHTML = content;
                modal.style.display = 'block';
            });
        });

        // When the user clicks on <span> (x) or OK button, close the modal
        const closeModal = () => {
            modal.style.display = 'none';
        };

        closeBtn.onclick = closeModal;

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    }

    function attachDoctorSearchEventListener() {
        console.log('Attaching doctor search listener...');
        const searchInput = document.getElementById('doctorSearchInput');
        if (!searchInput) {
            console.log('Doctor search input not found!');
            return;
        }

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim();
            const tableBody = document.querySelector('.doctors-table tbody');
            console.log(`Searching for: ${searchTerm}`);

            if (searchTerm === '') {
                loadContent('adminDoctors');
                return;
            }

            fetch(`../controller/adminDoctorsController.php?action=search_doctors&term=${encodeURIComponent(searchTerm)}`)
                .then(response => response.text())
                .then(data => {
                    console.log('Received data from server:', data);
                    tableBody.innerHTML = data;
                    attachDoctorDeleteEventListeners();
                })
                .catch(error => console.error('Doctor search error:', error));
        });
    }

    function attachDoctorDeleteEventListeners() {
        const deleteLinks = document.querySelectorAll('.delete-btn-doctor');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const doctorId = this.getAttribute('data-id');
                if (confirm(`Are you sure you want to delete this doctor?`)) {
                    fetch(`../controller/adminDoctorsController.php?action=delete_doctor&doctor_id=${doctorId}`)
                        .then(response => {
                            if (response.ok) {
                                loadContent('adminDoctors');
                            } else {
                                alert('Error: Could not delete doctor.');
                            }
                        })
                        .catch(error => console.error('Delete error:', error));
                }
            });
        });
    }

    function attachSearchEventListener() {
        const searchInput = document.getElementById('hospitalSearchInput');
        if (!searchInput) return;

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim();
            const tableBody = document.querySelector('.hospitals-table tbody');

            if (searchTerm === '') {
                loadContent('adminHospitals');
                return;
            }

            fetch(`../controller/adminHospitalsController.php?action=search&term=${encodeURIComponent(searchTerm)}`)
                .then(response => response.text())
                .then(data => {
                    tableBody.innerHTML = data;
                    // Re-attach delete listeners to the new rows
                    attachDeleteEventListeners();
                })
                .catch(error => console.error('Search error:', error));
        });
    }

    function attachDeleteEventListeners() {
        const deleteLinks = document.querySelectorAll('.delete-btn');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this hospital?')) {
                    fetch(this.href)
                        .then(response => {
                            if (response.ok) {
                                // After successfully deleting, reload the hospitals content
                                loadContent('adminHospitals');
                            } else {
                                alert('Error: Could not delete hospital.');
                            }
                        })
                        .catch(error => console.error('Error deleting hospital:', error));
                }
            });
        });
    }

    function getPageFromUrl() {
        const params = new URLSearchParams(window.location.search);
        return params.get('page');
    }

    // Handle sidebar clicks
sidebarLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        // Skip logout link (allow normal navigation)
        if (this.classList.contains('log-out')) {
            return; 
        }

        e.preventDefault();
        const page = this.getAttribute('data-page');
        // Update URL without reloading
        history.pushState({page: page}, ``, `adminDashboard.php?page=${page}`);
        loadContent(page);
    });
});


    // Load initial page based on URL or default to adminOverview
    const initialPage = getPageFromUrl() || 'adminOverview';
    loadContent(initialPage);

    // Handle browser back/forward buttons
    window.onpopstate = function(event) {
        const page = (event.state && event.state.page) ? event.state.page : 'adminOverview';
        loadContent(page);
    };
});
