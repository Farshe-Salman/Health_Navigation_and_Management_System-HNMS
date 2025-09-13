function showSection(sectionId) {
  // Hide all sections
  const sections = document.querySelectorAll('.section');
  sections.forEach(section => {
    section.style.display = 'none';
  });

  // Show the selected section
  const selectedSection = document.getElementById(sectionId);
  if (selectedSection) {
    selectedSection.style.display = 'block';
  }
}

function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('active');
}

// Initially show the dashboard, and handle active link styling
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.sidebar a');
  
  // Show dashboard by default
  showSection('dashboard');

  links.forEach(link => {
    link.addEventListener('click', function(event) {
      // For all links except logout
      if (!this.classList.contains('log-out')) {
        event.preventDefault();
        
        // Remove active class from all links
        links.forEach(link => link.classList.remove('active'));
        
        // Add active class to the clicked link
        this.classList.add('active');
        
        // Get sectionId from onclick attribute
        const sectionId = this.getAttribute('onclick').match(/'([^']+)'/)[1];
        showSection(sectionId);
      }
    });
  });
});
