import React, { useEffect, useState } from "react";
import Login from "./Login";
import PersonalAccount from "./PersonalAccount";
import ErrorPage from "./ErrorPage";

import { Routes, Route, useNavigate } from "react-router-dom";

const App = () => {
    const token = localStorage.getItem("token") ? true : false;
    const [auth, setAuth] = useState(token);
    const navigate = useNavigate();
    useEffect(() => {
        if (auth) {
            navigate("/account");
        }
    }, [auth]);

    return (
        <>
            <Routes>
                <Route path="/login" element={<Login />} />
                <Route path="/account" element={<PersonalAccount />} />
                <Route path="/error" element={<ErrorPage />} />
            </Routes>
        </>
    );
};

export default App;
