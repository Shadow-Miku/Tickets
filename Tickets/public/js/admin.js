////////////////////// Admin Layout //////////////////////
    // Profile Modal
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('button#profileImageButton img').addEventListener('click', function (e) {
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

////////////////////// Scripts for Users //////////////////////
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

////////////////////// Modals for Divisions //////////////////////
    // Create Division
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('createDivisionButton');
        if (button) {
            button.addEventListener('click', () => {
                new bootstrap.Modal(document.getElementById('createDivisionModal')).show();
            });
        }
    });

    // Edit Division
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.editDivisionButton');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const divisionId = button.getAttribute('data-division-id');
                const divisionName = button.getAttribute('data-division-name');
                const updateUrl = button.getAttribute('data-update-url');

                const form = document.getElementById('editDivisionForm');
                form.action = updateUrl;
                document.getElementById('editDivisionName').value = divisionName;

                new bootstrap.Modal(document.getElementById('editDivisionModal')).show();
            });
        });
    });


////////////////////// Assignment Modals //////////////////////
    // Modal info ticket
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

    // Modal assigned ticket info
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


// Modal assignment chat
document.addEventListener('DOMContentLoaded', function () {
    const answerModal = document.getElementById('answerModal');
    const replyModal = document.getElementById('replyModal');

    answerModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const answer = button.getAttribute('data-answer');
        const coment = button.getAttribute('data-coment');
        const obervation = button.getAttribute('data-observation');
        const chatId = button.getAttribute('data-chat-id');

        // Set the content of the modal answer
        document.getElementById('answerText').textContent = answer;
        // Set the content of the modal coment
        document.getElementById('comentText').textContent = coment;
        // Set the content of the modal observation
        document.getElementById('observationText').textContent = obervation;
        // Establece el chat ID en el botón de "Reply"
        document.getElementById('replyButton').setAttribute('data-chat-id', chatId);
    });

    replyModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const chatId = button.getAttribute('data-chat-id');

        // Set the value of the hidden input field
        document.getElementById('chatId').value = chatId;
    });
});

