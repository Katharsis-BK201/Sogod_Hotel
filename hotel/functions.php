<?php

    function validatePassword($password) {
    
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }

    function generatenum(){
        $accnum = rand(100000, 999999);
        $acc = "EMS-" . $accnum;
        return $acc;
    }

?>

<script>
        function togglePassword(inputId) {
            var x = document.getElementById(inputId);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var passwordInput = document.getElementById('password');
            var retypePasswordInput = document.getElementById('retype_password');
            var passwordError = document.getElementById('password-error');
            var retypePasswordError = document.getElementById('retype-password-error');

            passwordInput.addEventListener('input', function() {
                var password = this.value;
                var errors = [];

                if (!/[A-Z]/.test(password)) {
                    errors.push('Must have at least one capital letter');
                }
                if (!/[a-z]/.test(password)) {
                    errors.push('Must have at least one small letter');
                }
                if (!/[0-9]/.test(password)) {
                    errors.push('Must have at least one number');
                }
                if (!/[^A-Za-z0-9]/.test(password)) {
                    errors.push('Must have at least one special character');
                }
                if (password.length < 8) {
                    errors.push('Must have at least 8 characters');
                }

                passwordError.textContent = errors.join('. ');
            });

            retypePasswordInput.addEventListener('input', function() {
                var password = passwordInput.value;
                var retypePassword = this.value;

                if (password !== retypePassword) {
                    retypePasswordError.textContent = "Passwords do not match.";
                } else {
                    retypePasswordError.textContent = "";
                }
            });
        });



        function editAnnouncement(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to edit this announcement?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If 'Yes' is clicked, redirect to view page with encrypted ID
                window.location.href = `edit_announcement.php?id=${id}`;
            }
            // If 'Cancel' is clicked, do nothing (alert closes automatically)
        });
        }


        function deleteAnnouncement(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this announcement?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If 'Yes' is clicked, redirect to view page with encrypted ID
                window.location.href = `delete_announcement.php?id=${id}`;
            }
            // If 'Cancel' is clicked, do nothing (alert closes automatically)
        });

        }

        function viewAnnouncement(id) {
        // Display a SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to view this announcement?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If 'Yes' is clicked, redirect to view page with encrypted ID
                window.location.href = `view_announcement.php?id=${id}`;
            }
            // If 'Cancel' is clicked, do nothing (alert closes automatically)
        });
        }

</script>