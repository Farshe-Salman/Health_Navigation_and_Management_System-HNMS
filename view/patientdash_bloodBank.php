<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Blood Bank Section -->
      <div class="section" id="bloodBankSection" style="display:none;">
        <h2>Blood Bank</h2>

        <!-- Search -->
        <div class="blood-search">
          <select id="hospitalSelectBB">
            <option value="">All Hospitals</option>
            <option value="City General Hospital">City General Hospital</option>
            <option value="Sunrise Diagnostics">Sunrise Diagnostics</option>
          </select>

          <select id="bloodSearch">
            <option value="">Select Blood Type</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
          </select>

          <button onclick="searchBlood()">Search</button>
        </div>

        <!-- Blood List -->
        <div id="bloodList" class="blood-list">
          <!-- dynamically generated blood cards will appear here -->
        </div>
      </div>
      <!-- Blood Request Modal -->
      <div id="bloodRequestModal" class="modal" style="display:none;">
        <div class="modal-content">
          <h3>Request Blood</h3>
          <form id="bloodRequestForm">
            <input type="text" id="reqName" placeholder="Your Name" required>
            <input type="text" id="reqPhone" placeholder="Phone Number" required>
            <input type="text" id="reqNote" placeholder="Optional Note">
            <input type="hidden" id="reqHospital">
            <input type="hidden" id="reqBloodGroup">
            <button type="submit">Submit Request</button>
            <button type="button" onclick="closeBloodRequestModal()">Cancel</button>
          </form>
        </div>
      </div>
      <!-- Donor Details Modal -->
      <div id="donorModal" class="modal" style="display:none;">
        <div class="modal-content">
          <h3>Donor Details</h3>
          <p><strong>Name:</strong> <span id="donorName"></span></p>
          <p><strong>Contact:</strong> <span id="donorContact"></span></p>
          <p><strong>Hospital:</strong> <span id="donorHospital"></span></p>
          <p><strong>Blood Group:</strong> <span id="donorBloodGroup"></span></p>
          <button type="button" onclick="closeDonorModal()">Close</button>
        </div>
      </div>

</body>
</html>