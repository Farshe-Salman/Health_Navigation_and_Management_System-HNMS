<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <!-- ORDER HISTORY -->
<div id="orderHistory" class="section" style="display:none;">
  <h3>Order History</h3>
  <div class="table-container">
    <table class="orders-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Date</th>
          <th>Customer / Phone</th>
          <th>Region / City / Area</th>
          <th>Address</th>
          <th>Medicines</th>
          <th>Total (৳)</th>
          <th>Prescription</th>
          <th>Payment</th>
          <th>Status</th>
        
        </tr>
      </thead>
      <tbody id="orderHistoryList">
        <!-- Past orders will be dynamically loaded here -->
      </tbody>
    </table>
  </div>
</div>
</body>
</html>