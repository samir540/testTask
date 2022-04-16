import React, { useRef, useState, useContext } from "react";
import { Link, useNavigate } from "react-router-dom";

import axiosInstance from "./api/axiosInstance";


const Login = (props) => {
 

    const [user, setUser] = useState("");
    const [pwd, setPwd] = useState("");
   
    const [errMsg, setErrorMsg] = useState("");

    const navigate = useNavigate();
    const nameRef = useRef();
    const passwordRef = useRef();

    // useRef(() => {
    //     useRef.current.focus();
    // }, []);
    // useRef(() => {
    //     setErrorMsg("");
    // }, [user, pwd]);
    

    const submitHandler = (e) => {
        e.preventDefault();
        setPwd("");
        setUser("");
        const userData = {
            email: nameRef.current.value,
            password: passwordRef.current.value,
        };
      
            axiosInstance
                .post("login", userData)
                .then((response) => {
                    if (response.status == 200) {
                        const token = response.data.access_token.split("|")[1];
                        localStorage.setItem("token", token);

                        navigate("/account");
                    }
                })
                .catch((err) => {
                    if (err) {
                        navigate("/error");
                        console.log(err.message);
                        setErrorMsg(err.message);
                    }
                });
    };
    return (
        <form onSubmit={submitHandler}>
            <label htmlFor="name">Username:</label>
            <input
                type="email"
                id="name"
                ref={nameRef}
                onChange={(e) => setUser(e.target.value)}
                required
            />
            <label htmlFor="password">Password:</label>
            <input
                type="password"
                id="password"
                ref={passwordRef}
                onChange={(e) => setPwd(e.target.value)}
                required
            />
           
            <button>Sign in</button>
        </form>
    );
};

export default Login;
