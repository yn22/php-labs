function handleEmailSend(event) {
  event.preventDefault();

  const senderName = document.getElementById("id-sender-name");
  const senderEmail = document.getElementById("id-sender-email");
  const message = document.getElementById("id-message");

  const data = new FormData();
  data.append("sender_name", senderName.value);
  data.append("sender_email", senderEmail.value);
  data.append("message", message.value);

  const emailSentMessage = document.querySelector(".email-sent-message");

  fetch("./lab1/send_email.php", {
    method: "POST",
    body: data,
  })
    .then((response) => {
      emailSentMessage.classList.remove("hidden");
      if (response.ok) {
        alert("Email sent successfully");
      } else {
        alert("Error sending email");
      }
    })
    .finally(() => {
      senderName.value = "";
      senderEmail.value = "";
      message.value = "";
    });
}
