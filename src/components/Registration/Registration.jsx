import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import './Registration.css';

export const Registration = () => {
    const [fio, setFio] = useState('');
    const [email, setEmail] = useState();
    const [phone, setPhone] = useState();
    const [password, setPassword] = useState();

    const navigate = useNavigate();

    const registrationFunc = () => {
        window.localStorage.clear();
        const fioArr = fio.split(' ');
        if ((fioArr.length < 3) || !email || !phone || !password) {
            alert('Проверьте введенные данные');
        } else {
            const firstName = fioArr[1];
            const secondName = fioArr[0];
            const patronymic = fioArr[2];

            const data = {
                firstName,
                secondName,
                patronymic,
                email,
                phone,
                jobTitle: '',
                role: 'patient',
                password: password,
            };
            fetch('http://eds/users/create.php', {
                headers: {
                    'Content-Type': 'application/json',
                    "Access-Control-Allow-Methods": "POST",
                    'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'
                },
                method: 'POST',
                body: JSON.stringify(data)
            }).then(() => {
                navigate('/login');
            })
        }
    }

    return (
        <div className='reg-root'>
            <h2 className='registration-header'>Регистрация</h2>

            <div className='inputs'>
                <div>
                    <h3 className='input-registration-text'>ФИО</h3>
                    <input
                        className='input-registration'
                        type='name'
                        placeholder='Иванов Иван Иванович'
                        onChange={e => setFio(e.target.value)}
                    />
                </div>
                
                <div>
                    <h3 className='input-registration-text'>E-mail</h3>
                    <input
                        className='input-registration'
                        type='email'
                        placeholder='example@email.com'
                        onChange={e => setEmail(e.target.value)}
                    />
                </div>
                
                <div>
                    <h3 className='input-registration-text'>Номер телефона</h3>
                    <input
                        className='input-registration'
                        type='tel'
                        placeholder='+7 (***) *** ** **'
                        onChange={e => setPhone(e.target.value)}
                    />
                </div>
                
                <div>
                    <h3 className='input-registration-text'>Пароль</h3>
                    <input
                        className='input-registration'
                        type='password'
                        placeholder='********'
                        onChange={e => setPassword(e.target.value)}
                    />
                </div>
            </div>

            <div className='registration-button' onClick={() => registrationFunc()}>Зарегистрироваться</div>
        </div>
    );
}