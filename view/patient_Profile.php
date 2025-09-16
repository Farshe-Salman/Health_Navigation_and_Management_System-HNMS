<!-- Patient Profile Section -->
<div class="section" id="profileSection" style="display:none;">
    <h2>My Profile</h2>
    <form id="profileForm">

        <!-- Profile Image -->
        <div class="profile-field">
            <label>Profile Image:</label>
            <div class="field-row">
                <img id="profileImagePreview" src="default-profile.png" alt="Profile Image">
                <input type="file" id="profileImageInput" accept="image/*" style="margin-left:10px;">
                <button type="button" class="rightbtn" onclick="uploadProfileDoc('profileImage')">Upload Image</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="username">Username:</label>
            <div class="field-row">
                <input type="text" id="username" placeholder="User Name" value="user123" disabled required>
                <button type="button" class="edit-btn" onclick="enableEdit('profileName')">Edit</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="profileName">Full Name:</label>
            <div class="field-row">
                <input type="text" id="profileName" placeholder="Full Name" value="Shizan Sarkar" disabled required>
                <button type="button" class="edit-btn" onclick="enableEdit('profileName')">Edit</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="profileEmail">E-mail:</label>
            <div class="field-row">
                <input type="email" id="profileEmail" placeholder="Email" value="shizan@example.com" disabled required>
                <button type="button" class="edit-btn" onclick="enableEdit('profileEmail')">Edit</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="profilePhone">Phone no:</label>
            <div class="field-row">
                <input type="text" id="profilePhone" placeholder="Phone Number" value="01712345678" disabled required>
                <button type="button" class="edit-btn" onclick="enableEdit('profilePhone')">Edit</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="profileGender">Gender:</label>
            <div class="field-row">
                <select id="profileGender" disabled required>
                    <option value="">Select Gender</option>
                    <option value="Male" selected>Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <button type="button" class="edit-btn" onclick="enableEdit('profileGender')">Edit</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="profileDOB">Date of Birth:</label>
            <div class="field-row">
                <input type="date" id="profileDOB" value="2002-01-01" disabled required>
                <button type="button" class="edit-btn" onclick="enableEdit('profileDOB')">Edit</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="profileAge">Age:</label>
            <div class="field-row">
            <input type="text" id="profileAge" value="" disabled>
            <button type="button" class="edit-btn" onclick="enableEdit('profileAge')">Edit</button>
            </div>
        </div>

        <div class="profile-field">
            <label for="profileBloodGroup">Blood Group:</label>
            <div class="field-row">
                <select id="profileBloodGroup" disabled required>
                    <option value="">Select Blood Group</option>
                    <option value="A+" selected>A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
                <button type="button" class="edit-btn" onclick="enableEdit('profileBloodGroup')">Edit</button>
            </div>
        </div>

        <!-- Address Field -->
        <div class="profile-field">
            <label for="profileAddress">Address:</label>
            <div class="field-row">
                <input id="profileAddress" placeholder="Enter your address" disabled required rows="3">
                <button type="button" class="edit-btn" onclick="enableEdit('profileAddress')">Edit</button>
            </div>
        </div>

        <button type="submit" class="petient-btn-primary">Save Changes</button>
    </form>
</div>
