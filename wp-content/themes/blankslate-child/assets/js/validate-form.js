async function submitForm() {
  const emailInput = document.getElementById("email");
  const legalNotice = document.getElementById("legalNotice");

  // Validar el aviso legal
  if (!legalNotice.checked) {
    alert("Debes aceptar el Aviso Legal para continuar.");
    return;
  }

  // Validar el email
  const email = emailInput.value;
  if (!email) {
    alert("Por favor, introduce tu correo electrónico.");
    return;
  }

  // Enviar la solicitud al endpoint REST usando wpApiSettings.root como URL
  try {
    const response = await fetch(wpApiSettings.root, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ email: email }),
    });

    const result = await response.json();
    if (response.ok) {
      alert(result); // Muestra "Gracias por suscribirte!" si el registro es exitoso
    } else {
      alert("Error: " + result.message);
    }
  } catch (error) {
    alert(
      "Hubo un problema al enviar el formulario. Por favor, intenta de nuevo."
    );
    console.error("Error:", error);
  }
}
