// Admin Layout
    // Profile Modal
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('button#userDropdown img').addEventListener('click', function (e) {
            e.preventDefault();
            var profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
            profileModal.show();
        });

        // Hover effect for the profile image
        const profileImageLink = document.querySelector('#profileModal a');
        const hoverText = profileImageLink.querySelector('div');

        profileImageLink.addEventListener('mouseover', () => {
            hoverText.classList.remove('d-none');
            profileImageLink.querySelector('img').classList.add('darken');
        });

        profileImageLink.addEventListener('mouseout', () => {
            hoverText.classList.add('d-none');
            profileImageLink.querySelector('img').classList.remove('darken');
        });
    });

// Users
    // View: createuser
    document.addEventListener('DOMContentLoaded', function() {
        function previewImage(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        // Asigna el evento change al input de tipo file
        document.getElementById('url').addEventListener('change', function() {
            previewImage(this);
        });
    });




//View: indexassigned
    // Modal ticket
    document.addEventListener('DOMContentLoaded', function() {
        var ticketModal = document.getElementById('ticketModal');
        ticketModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ticketId = button.getAttribute('data-ticket-id');
            var clasification = button.getAttribute('data-clasification');
            var details = button.getAttribute('data-details');
            var status = button.getAttribute('data-status');

            var modalTicketId = ticketModal.querySelector('#modal-ticket-id');
            var modalClasification = ticketModal.querySelector('#modal-clasification');
            var modalDetails = ticketModal.querySelector('#modal-details');
            var modalStatus = ticketModal.querySelector('#modal-status');

            modalTicketId.textContent = ticketId;
            modalClasification.textContent = clasification;
            modalDetails.textContent = details;
            modalStatus.textContent = status;
        });
    });

    // Modal assigned ticket
    document.addEventListener('DOMContentLoaded', function() {
        var assignmentModal = document.getElementById('assignmentModal');
        assignmentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ticketId = button.getAttribute('data-ticket-id');
            var clasification = button.getAttribute('data-clasification');
            var details = button.getAttribute('data-details');
            var status = button.getAttribute('data-status');
            var author = button.getAttribute('data-author');
            var accountableName = button.getAttribute('data-accountable-name');
            var divisionName = button.getAttribute('data-division-name');
            var createdAt = button.getAttribute('data-created-at');
            var updatedAt = button.getAttribute('data-updated-at');

            var modalTicketId = assignmentModal.querySelector('#modal-ticket-id');
            var modalClasification = assignmentModal.querySelector('#modal-clasification');
            var modalDetails = assignmentModal.querySelector('#modal-details');
            var modalStatus = assignmentModal.querySelector('#modal-status');
            var modalAuthor = assignmentModal.querySelector('#modal-author');
            var modalAccountableName = assignmentModal.querySelector('#modal-accountable-name');
            var modalDivisionName = assignmentModal.querySelector('#modal-division-name');
            var modalCreatedAt = assignmentModal.querySelector('#modal-created-at');
            var modalUpdatedAt = assignmentModal.querySelector('#modal-updated-at');

            modalTicketId.textContent = ticketId;
            modalClasification.textContent = clasification;
            modalDetails.textContent = details;
            modalStatus.textContent = status;
            modalAuthor.textContent = author;
            modalAccountableName.textContent = accountableName;
            modalDivisionName.textContent = divisionName;
            modalCreatedAt.textContent = createdAt;
            modalUpdatedAt.textContent = updatedAt;
        });
    });




