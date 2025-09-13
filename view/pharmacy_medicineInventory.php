<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <!-- Medicine Inventory -->
    <div id="inventory" class="section" style="display:none;">
      <h3>Medicine Inventory</h3>
      <button class="btn-primary" onclick="openAddMedicineSection()">Add New Medicine</button>
      <div id="inventoryMedicineList" class="medicine-list">
        <!-- Medicines will be dynamically loaded here via JS -->
      </div>
    </div>

    <!-- Add Medicine Section -->
    <div id="addMedicineSection" class="section" style="display:none;">
      <h3>Add Medicines</h3>
      <div class="medicine-container">
        <!-- Left: Medicine Info -->
        <div id="addmedicineInfoContainer" class="medicine-box">
          <h4>Medicine Information</h4>
          <form id="addMedicineFormSection">
            <div class="medicine-field">
              <label>Medicine Name:</label>
              <input type="text" id="medNameSection" placeholder="Enter Medicine Name" required>
            </div>
            <div class="medicine-field">
              <label>Category:</label>
              <select id="medCategorySection" required>
                <option value="">Select category</option>
                <option value="medicine">Medicine</option>
                <option value="firstAid">First Aid</option>
                <option value="equipment">Medical Equipment</option>
                <option value="skincare">Skincare</option>
              </select>
            </div>
            <div class="medicine-field">
              <label>Stock:</label>
              <input type="number" id="medStockSection" placeholder="0" required>
            </div>
            <div class="medicine-field">
              <label>Price (৳):</label>
              <input type="number" id="medPriceSection" placeholder="0" required>
            </div>
            <div class="medicine-field">
              <label>Expiry Date:</label>
              <input type="date" id="medExpirySection" required>
            </div>
            <div class="medicine-field">
              <label>Prescription Required:</label>
              <select id="prescriptionRequiredSection" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
            <button type="submit" class="rightbtn">Save Medicine</button>
          </form>
        </div>
        <!-- Right: Document Uploads -->
        <div id="medicineDocsContainer" class="medicine-box">
          <h4>Required Documents</h4>
          <div class="doc-item">
            <label>Drug Image:</label>
            <input type="file" id="drugImageFileSection" accept=".jpg,.png" required>
          </div>
          <div class="doc-item">
            <label>Drug License (PDF/JPG):</label>
            <input type="file" id="drugLicenseFileSection" accept=".pdf,.jpg,.png" required>
          </div>
          <div class="doc-item">
            <label>Import Certificate (if applicable):</label>
            <input type="file" id="importCertFileSection" accept=".pdf,.jpg,.png">
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Medicine Section -->
    <div id="editMedicineSection" class="section" style="display:none;">
      <h3>Edit Medicine</h3>
      <div class="medicine-container">
        <!-- Left: Medicine Info -->
        <div id="editMedicineInfoContainer" class="medicine-box">
          <h4>Medicine Information</h4>
          <form id="editMedicineFormSection">
            <div class="medicine-field">
              <label>Medicine Name:</label>
              <input type="text" id="editmedNameSection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedNameSection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Category:</label>
              <select id="editmedCategorySection" required disabled>
                <option value="">Select category</option>
                <option value="medicine">Medicine</option>
                <option value="firstAid">First Aid</option>
                <option value="equipment">Medical Equipment</option>
                <option value="skincare">Skincare</option>
              </select>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedCategorySection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Stock:</label>
              <input type="number" id="editmedStockSection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedStockSection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Price (৳):</label>
              <input type="number" id="editmedPriceSection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedPriceSection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Expiry Date:</label>
              <input type="date" id="editmedExpirySection" required disabled>
              <button type="button" class="edit-btn" onclick="enableEdit('editmedExpirySection')">Edit</button>
            </div>
            <div class="medicine-field">
              <label>Prescription Required:</label>
              <select id="editprescriptionRequiredSection" required disabled>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <button type="button" class="edit-btn"
                onclick="enableEdit('editprescriptionRequiredSection')">Edit</button>
            </div>
            <button type="submit" class="rightbtn">Update Medicine</button>
          </form>
        </div>
        <!-- Right: Document Uploads -->
        <div id="editMedicineDocsContainer" class="medicine-box">
          <h4>Required Documents</h4>
          <div class="doc-item">
            <label>Drug Image:</label>
            <input type="file" id="editdrugImageFileSection" accept=".jpg,.png" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editdrugImageFileSection')">Upload</button>
          </div>
          <div class="doc-item">
            <label>Drug License (PDF/JPG):</label>
            <input type="file" id="editdrugLicenseFileSection" accept=".pdf,.jpg,.png" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editdrugLicenseFileSection')">Upload</button>
          </div>
          <div class="doc-item">
            <label>Import Certificate (if applicable):</label>
            <input type="file" id="editimportCertFileSection" accept=".pdf,.jpg,.png" disabled>
            <button type="button" class="rightbtn" onclick="enableFile('editimportCertFileSection')">Upload</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>