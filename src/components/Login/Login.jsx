import './Login.css';
import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';

export const Login = () => {
    const [user, setUser] = useState([]);
    const [login, setLogin] = useState('');
    const [password, setPassword] = useState('');

    const navigate = useNavigate();

    const loginFunc = () => {
        const data = {
          email: login,
          password: password,
        };
        fetch('http://eds/users/findUser.php', {
          method: 'POST',
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(json => {
          json.data.map(d => {
              window.localStorage.setItem('firstName', d.firstName);
              window.localStorage.setItem('secondName', d.secondName);
              window.localStorage.setItem('patronymic', d.patronymic);
              window.localStorage.setItem('role', d.role);
              setUser(d);
          });
        })
    }

    useEffect(() => {
        if (window.localStorage.getItem('firstName') && window.localStorage.getItem('firstName') !== (undefined || null)) navigate('/');
    }, [user])

    return (
        <div className='login-root'>
            <h2 className='login-header'>Вход</h2>

            <div className='inputs'>
                <div>
                    <h3 className='input-login-text'>Логин</h3>
                    <input className='input-login' type='email' value={login} onChange={e => setLogin(e.target.value)} />
                </div>
                
                <div>
                    <h3 className='input-login-text'>Пароль</h3>
                    <input className='input-login' type='password' value={password} onChange={e => setPassword(e.target.value)}  />
                </div>
            </div>

            <div className='forgot-password'>Забыли пароль?</div>

            <div className='login-button' onClick={() => loginFunc()}>Войти</div>

            <div className='registration'>Нет аккаунта? Регистрация</div>
        </div>
    );
};