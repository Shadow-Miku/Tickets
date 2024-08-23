
////////////////////// Tickets Modals //////////////////////
// Ticlet Details Modal
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

// Assignment Chat Modal
    document.addEventListener('DOMContentLoaded', function () {
        const answerModal = document.getElementById('answerModal');
        const replyModal = document.getElementById('replyModal');

        answerModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const answer = button.getAttribute('data-answer');
            const chatId = button.getAttribute('data-chat-id');

            // Set the content of the modal answer
            document.getElementById('answerText').textContent = answer;
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




