document.addEventListener('DOMContentLoaded', function() {

    function setupLiveTableFilter(searchInputId, tableBodyId, searchColumns) {
        const searchInput = document.getElementById(searchInputId);
        const tableBody = document.getElementById(tableBodyId);

        if (searchInput && tableBody) {
            const tableRows = tableBody.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const searchTerm = searchInput.value.toLowerCase();

                for (let i = 0; i < tableRows.length; i++) {
                    const row = tableRows[i];
                    let rowText = '';

                    searchColumns.forEach(index => {
                        if (row.cells[index]) {
                            rowText += row.cells[index].textContent.toLowerCase() + ' ';
                        }
                    });

                    if (rowText.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        }
    }

    // Setup for the Diagnostic Services page (Search by Hospital and Service)
    setupLiveTableFilter('serviceSearchInput', 'servicesTableBody', [0, 1]);

    // Setup for the Surgery Packages page (Search by Hospital and Surgery)
    setupLiveTableFilter('surgerySearchInput', 'surgeryTableBody', [0, 1]);

    // Setup for the Ambulance Services page (Search by Hospital and Code)
    setupLiveTableFilter('ambulanceSearchInput', 'ambulanceTableBody', [0, 1]);

    // Setup for the Blood Donor page (Search by Name and Blood Group)
    setupLiveTableFilter('donorSearchInput', 'donorTableBody', [0, 3]);

});