import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axiosInstance from "./api/axiosInstance";

const PersonalAccount = (props) => {
  
    const [data, setData] = useState(null);
    const navigate = useNavigate();

    useEffect(() =>  {
       
        if (localStorage.getItem("token") === null) {
            navigate("/");
        }

        axiosInstance.get("/me").then((res) => {
            setData(  res.data);
        });
      
    }, []);
       const logoutHandler = () => {
           localStorage.clear();
       };
    console.log("data:" + data);
   
    return (
        <>
            {data && (
                <div>
                    <p>Personal Account </p>
                    <p>Name: {data.data.name} </p>
                    <p>Position:</p>
                    <p>Email:</p>
                    <Link to="/login">
                        <button onClick={logoutHandler}>Logout</button>
                    </Link>
                </div>
            )}
        </>
    );
};

export default PersonalAccount;
