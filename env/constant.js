// const PROJECT_STATUS = 'LIVE' ;
const PROJECT_STATUS = 'DEV';

// PROJECT DETAILS --------------------------------------------------------------------------------------------

let API = '';

let UPLOAD_FOLDER = '';
let UPLOAD_URL = 'https://uploads.sysrootsolution.com/';

const project_data = {
    name: "Adego",
    dl_no: "",
    address: "",
    email: "",
    contact: "",
    forgot_email: "",
    contact_email: "",
    whatsapp: "",
    billing_prefix: "",
};

(function (data) {
    const { name } = data;

    $("#project-name").text(name);
    let today = new Date();
    $("#copyright-data").text(`${today.getFullYear()} ${name}`);

})(project_data);

if (PROJECT_STATUS == 'LIVE') {

    API = 'https://adego.in/api/';
    UPLOAD_FOLDER = '';

} else {

    API = 'http://localhost/2024/adego/api/';
    UPLOAD_FOLDER = 'test';
}