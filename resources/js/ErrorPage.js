import React from 'react';
import {Link} from "react-router-dom";
 
const ErrorPage = () => {
  return (
      <>
          <div>Page not fount...</div>
          <Link to="/login" >
              <button>Back to home page</button>
          </Link>
      </>
  );
}

export default ErrorPage;