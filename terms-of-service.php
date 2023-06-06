<?php
$title = "Terms of Service";
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once("config.php") ?>

<body>
    <?php require("components/navbar.php") ?>

    <style>
        body {
            max-width: 100%;
        }

        span.__title {
            font-size: 120%;
            font-family: "Metropolis Black";
            width: 100%;
            text-align: center;
        }

        div.__content {
            padding: 50px 20% 50px 20%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
        }

        div.__content>span {
            width: 100%;
        }

        a.__back-btn {
            display: flex;
            flex-direction: row;
            padding: 30px 0 30px 0;

            cursor: pointer;
            text-decoration: none;
        }

        a.__back-btn>* {
            width: fit-content;
            display: flex;
            flex-direction: row;
            margin: 0 10px 0 10px;
        }

        @media only screen and (max-width: 700px) {
            div.__content {
                padding: 50px 10% 50px 10%;
                max-width: 100%;
                display: flex;
            }
        }
    </style>


    <div class="__content">
        <a class="__back-btn" href="<?php echo $_GET['prevpage']; ?>">
            <i class="fa-solid fa-chevron-left"></i>
            <span>BACK</span>
        </a>
        <span>
            <span class="__title">Casa Querencia Facility Reservation Management System - TERMS OF SERVICE</span>
            <p>
                <i>
                    These Terms of Service ("Terms") govern your use of the Casa Querencia Facility Reservation Management System ("App") provided by LakbayTek ("Provider"). By accessing or using the App, you agree to be bound by these Terms. If you do not agree with these Terms, you may not use the App.
                </i>
            </p>

            <h2>Account Creation and Security</h2>

            <p>1.1 Account Creation: In order to use the App, you must create an account. You are responsible for providing accurate and complete information during the registration process. You must keep your account credentials, including username and password, confidential and not share them with any third party.</p>

            <p>1.2 Account Security: You are solely responsible for maintaining the security of your account. You agree to notify the Provider immediately of any unauthorized use of your account or any other breach of security.</p>

            <h2>Reservation Management</h2>

            <p>2.1 Facility Availability: The App allows you to view the availability of resort facilities and make reservations based on the provided information. However, availability may change at any time, and the Provider does not guarantee the accuracy or availability of the facilities displayed on the App.</p>

            <p>2.2 Reservation Confirmation: Making a reservation through the App does not guarantee the availability of the chosen facility. The Provider reserves the right to confirm or deny any reservation request at its discretion. A confirmed reservation will be subject to additional terms and conditions agreed upon between you and the Provider.</p>

            <p>2.3 Cancellation and Refunds: Cancellation and refund policies are determined by the Provider and may vary based on the specific terms and conditions associated with each reservation. It is your responsibility to review and understand the cancellation and refund policies before making a reservation.</p>

            <h2>User Obligations</h2>

            <p>3.1 Compliance with Laws: You agree to use the App in compliance with all applicable laws, regulations, and third-party agreements.</p>

            <p>3.2 Accuracy of Information: You represent and warrant that all information you provide through the App is accurate and up-to-date. You acknowledge that the Provider may rely on the information provided by you for the purpose of reservation management.</p>

            <p>3.3 Prohibited Activities: You must not use the App for any unlawful, harmful, or fraudulent activities, including but not limited to:</p>

            <p>
            <p>a) Accessing or attempting to access unauthorized areas of the App.</p>
            <p>b) Uploading or transmitting viruses, malware, or any other harmful code.</p>
            <p>c) Interfering with or disrupting the functionality of the App.</p>
            <p>d) Impersonating any person or entity.</p>
            </p>

            <h2>Intellectual Property</h2>

            <p>4.1 App Ownership: The App and all intellectual property rights associated with it are owned by the Provider. These Terms do not grant you any ownership rights or licenses to the App or its contents.</p>

            <p>4.2 User Content: By using the App, you grant the Provider a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, adapt, publish, and display any content you submit or provide through the App for the purpose of providing the services offered by the App.</p>

            <h2>Limitation of Liability</h2>

            <p>5.1 Disclaimer of Warranties: The App is provided on an "as-is" and "as available" basis. The Provider does not make any warranties or representations regarding the availability, reliability, or accuracy of the App or its content.</p>

            <p>5.2 Limitation of Liability: To the maximum extent permitted by law, the Provider and its affiliates, officers, directors, employees, and agents shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenue, arising out of or in connection with your use of the App.</p>

            <h2>Modification and Termination</h2>

            <p>6.1 Modification: The Provider reserves the right to modify or update these Terms at any time. Any changes will be effective upon posting the revised Terms on the App. Your continued use of the App after the changes will indicate your acceptance of the modified Terms.</p>

            <p>6.2 Termination: The Provider may terminate or suspend your access to the App at any time, with or without cause, and without prior notice.</p>

            <h2>Governing Law</h2>

            <p>These Terms shall be governed by and construed in accordance with the laws of the Republic of the Philippines. Any disputes arising out of or in connection with these Terms shall be subject to the exclusive jurisdiction of the courts located in the Republic of the Philippines..</p>

            <p>By using the App, you acknowledge that you have read, understood, and agreed to these Terms of Service. If you do not agree with any provision of these Terms, please do not use the App.</p>
        </span>
    </div>
</body>

</html>