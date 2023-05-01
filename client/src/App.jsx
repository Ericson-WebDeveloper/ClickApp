import { useEffect, useRef, useState } from "react";
import "./App.css";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import api from "./api/api";
import moment from "moment/moment";

function App() {
  const [clicks, setClicks] = useState(0);
  const shoudlRun = useRef(true);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    if (shoudlRun.current) {
      shoudlRun.current = false;
      setLoading(true);
      api
        .get("clicks")
        .then(({data}) => {
          setClicks(data.clicks?.clicks || 0);
        })
        .catch((error) => {
          if (error.response) {
            toast.error("Server error please try again later");
          } else if (error.request) {
            toast.error("Server not response. please try again later");
          } else {
            toast.error("Server error please try again later", error.message);
          }
        })
        .finally(() =>
          setTimeout(() => {
            setLoading(false);
          }, 500)
        );
    }
  }, []);

  const handleClick = () => {
    setLoading(true);
    api
      .post("clicks")
      .then(({data}) => {
        setClicks(data.click?.clicks);
      })
      .catch((error) => {
        if (error.response) {
          toast.error("Server error please try again later");
        } else if (error.request) {
          toast.error("Server not response. please try again later");
        } else {
          toast.error("Server error please try again later", error.message);
        }
      })
      .finally(() =>
        setTimeout(() => {
          setLoading(false);
        }, 500)
      );
  };

  return (
    <div className="flex w-full h-screen bg-[#e9edf9]">
      <div className="flex flex-col w-full h-full justify-center items-center space-y-3">
        <p className="text-[20px] font-sans font-extrabold">{moment().format('MMMM Do YYYY')}</p>
        <button
          className="p-6 bg-blue-600 text-yellow-50 text-2xl font-semibold rounded-xl hover:bg-blue-400 disabled:opacity-50"
          onClick={handleClick}
          disabled={loading}
        >
          Click Me!
        </button>
        
        <p
          className="text-[105px] font-sans font-extrabold span"
          style={{
            position: "absolute"
          }}
        >
          {loading ? `...Loading` : clicks}
        </p>
      </div>
      <ToastContainer />
    </div>
  )
}

export default App
