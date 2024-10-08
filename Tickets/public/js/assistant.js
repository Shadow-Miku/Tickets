////////////////////// Assistant Layout //////////////////////
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

////////////////////// Tickets Modal //////////////////////
    // Assignment Modal
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

    // Chat Modal
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
