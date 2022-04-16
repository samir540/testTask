import axios from "axios";

const token = localStorage.getItem("token");


if(token){
    axios.defaults.headers.common = { Authorization: `Bearer ${token}` };
}


export default axios.create({
    baseURL: "http://127.0.0.1:8000/api/v1/",
});