<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- External CSS import -->
        <link rel="stylesheet" href="styles/main.css">
        <title>PHP Midterm - Problem 2</title>
    </head>
    <body>
        <div class="container">
            <h1>Student Parking Pass Permit Registration</h1>
            <form action="backend/permitInput.php" method="POST">
                <!-- Student ID -->
                <div class="form-group">
                    <label for="studentId">Student ID:</label>
                    <input 
                        type="text" 
                        id="studentId" 
                        name="studentId" 
                        required
                    >
                </div>
                <!-- Name Fields -->
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input 
                        type="text" 
                        id="firstName" 
                        name="firstName" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name:</label>
                    <input 
                        type="text" 
                        id="middleName" 
                        name="middleName"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input 
                        type="text" 
                        id="lastName" 
                        name="lastName" 
                        required
                    >
                </div>
                <!-- Address Fields -->
                <div class="form-group">
                    <label for="homeAddress">Home Address:</label>
                    <input 
                        type="text" 
                        id="homeAddress" 
                        name="homeAddress" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input 
                        type="text" 
                        id="city" 
                        name="city" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="state">State:</label>
                    <input 
                        type="text" 
                        id="state" 
                        name="state" 
                        maxlength="2" 
                        placeholder="MA" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="zip">Zip Code:</label>
                    <input 
                        type="text" 
                        id="zip" 
                        name="zip" 
                        pattern="[0-9]{5}" 
                        placeholder="12345" 
                        required
                    >
                </div>
                <!-- Contact Information -->
                <div class="form-group">
                    <label for="cellPhone">Cell Phone Number:</label>
                    <input 
                        type="tel" 
                        id="cellPhone" 
                        name="cellPhone" 
                        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                        placeholder="123-456-7890" 
                        required
                    >
                </div>
                <!-- Permit Number -->
                <div class="form-group">
                    <label for="permitNumber">Permit Number:</label>
                    <input 
                        type="text" 
                        id="permitNumber" 
                        name="permitNumber" 
                        pattern="BHCC[0-9]{3}" 
                        placeholder="BHCCxxx" 
                        required
                    >
                </div>
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit">Submit Permit Application</button>
                </div>
            </form>
        </div>
    </body>
</html>