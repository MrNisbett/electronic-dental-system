import { useEffect, useState } from 'react';
import { redirect, Route, Routes, useNavigate } from 'react-router-dom';
import { CreateTicket } from './components/CreateTicket/CreateTicket';
import { Login } from './components/Login/Login';
import { Profile } from './components/Profile/Profile';
import { Registration } from './components/Registration/Registration';

export const redirectFunc = (path) => {
  redirect(path);
}

function App() {
  const [user, setUser] = useState([]);
  const [usersList, setUsersList] = useState();

  const navigate = useNavigate();
  
  useEffect(() => {
    if (window.localStorage.getItem('firstName') === undefined){
      navigate('/login')
    }
  }, [navigate, window.localStorage]);
  
  return (
    <>
      <Routes>
          <Route path='/' element={<Profile user={user} usersList={usersList} setUsersList={setUsersList} />} />
          <Route path='/login' element={<Login user={user} setUser={setUser} />} />
          <Route path='/registration' element={<Registration user={user} setUser={setUser} />} />
          <Route path='/create-ticket' element={<CreateTicket />} />
      </Routes>
    </>
  );
}

export default App;
