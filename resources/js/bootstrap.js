import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Add this configuration to disable the Origin header
window.axios.defaults.headers.common['Origin'] = '';

// If you want to allow credentials (cookies, HTTP authentication) with CORS, add:
// window.axios.defaults.withCredentials = true;