//
// Consiguiendo los element
//
const getTagByClass = (selector) => document.querySelectorAll(`.${selector}`);
const getBySelector = (selector) => document.querySelector(selector)
const getById = (id)=> document.getElementById(`${id}`)

const formArticles = getTagByClass("sectionForm .parentInputs");
const loginButtons = getTagByClass("btnsLogin button");
const iconButtons = getTagByClass("parentInputPassword .iconEyes");
const formPrincipal = getById("formLogin");

const applyToEach = (elements, callback) => elements.forEach(callback);

applyToEach(iconButtons, (e) => e.addEventListener("click", eventIcon));

//
//Moviendo el login y signUp
//
let lastTargetEvent = loginButtons[0];
const handleLoginButtonClick = (event) => {
  event.preventDefault();

  const { currentTarget } = event;
  const { src } = currentTarget.dataset;
  // const { article } = lastTargetEvent.dataset;

  formPrincipal.action = `src/views/${src}.php`;
  if (currentTarget == lastTargetEvent) return;

  lastTargetEvent = currentTarget;
  applyToEach(loginButtons, (el) => el.classList.toggle("lineBtn"));

  formArticles[1].classList.toggle("parentHidden");
 
};
applyToEach(loginButtons, (btn) =>
  btn.addEventListener("click", handleLoginButtonClick)
);

//
// Activando y ocultando icon
//
const eventIcon = (el) => {
  const { currentTarget } = el;
  const input = currentTarget
    .closest(".parentInputPassword")
    .querySelector("input");

  input.type = input.type === "text" ? "password" : "text";

  Array.from(currentTarget.children).forEach((el) =>
    el.classList.toggle("iconNone")
  );
};

//
//  Verificando y comparando el password y passwordRepeat
//
const messagePassRepeat = getBySelector("label .messagePassRepeat");
const messagePass = getBySelector("label .messagePass");

const valuesPassword = { password: "",passwordRepeat: ""};
const changePassword = (event) => {

  const { currentTarget } = event;
  const { id, value } = currentTarget;

  valuesPassword[id] = value;

  if (id == "password") {
    validPattern(currentTarget, messagePass);
    return;
  }

  //
  // Verificando si el input pertenece a una etiqueta padre de validacion
  //
  const elementParent = currentTarget.closest("label").closest("article");
  const includeSignUp = Array.from(elementParent.classList).includes("fieldsSignUp");
  
  if (includeSignUp) {
    const { password, passwordRepeat } = valuesPassword;
    let responseMessage = (password === passwordRepeat) ? ["correcta", "rgb(122, 90, 227)"] : ["No coincide la contrasena", "rgb(241, 124, 124)"];

    messagePassRepeat.textContent = responseMessage[0];
    messagePassRepeat.style.color = responseMessage[1];
  }
};

getTagByClass(`parentInputPassword input`).forEach((element) =>element.addEventListener("input", changePassword));

const messageUsername = getBySelector("label .messageUsername"); 
getById("username").addEventListener("input", ({currentTarget}) => validPattern(currentTarget, messageUsername) );

const messageEmail = getBySelector("label .messageEmail");
getById("emailSignUp").addEventListener('input', ({currentTarget}) => validPattern(currentTarget, messageEmail) );


//
//Mensajes de error
//
const messagesError = (input, [start, end] ) =>({
    valueMissing: "Este campo es obligatorio",
    typeMismatch: `Debes ingresar un ${input.type} válido`,
    patternMismatch: `El ${input.title} debe tener entre ${start} y ${end} caracteres`,
    tooShort: `Debe tener al menos ${start} caracteres`,
    tooLong: `Debe tener como máximo ${end} caracteres`,
    badInput: "Entrada inválida",
    stepMismatch: "El valor no es válido para este campo",
    rangeUnderflow: "El valor es demasiado bajo",
    rangeOverflow: "El valor es demasiado alto",
    customError: input.validationMessage,
  });



//
//Validando los patrones de los input de entradas
//
const validPattern = (input, messageElement) => {

    let start = input.min
    let end = input.max

    let validity = input.validity;
    const messages = messagesError(input,[start,end])

    for (const key in messages) {
        messageElement.textContent = validity[key] ? messages[key] : "";
        if (validity[key]) break;
    } 
};
