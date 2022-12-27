import './Profile.css';
import React, { useEffect, useState } from 'react';
import { UserCard } from '../UserCard/UserCard';
import { useNavigate } from 'react-router-dom';
import { Registry } from '../Registry/Registry';

export const Profile = () => {
    const navigate = useNavigate();
    const [tickets, setTickets] = useState([]);
    const name = window.localStorage.getItem('secondName') + ' ' + window.localStorage.getItem('firstName');
    const role = (window.localStorage.getItem('role') === 'patient') ? 'пациент' : 'врач';

    const getAllTickets = () => {
        fetch('http://eds/tickets/read.php')
        .then(response => response.json())
        .then(json => setTickets(json.data))
    }

    const getUserTickets = () => {
        fetch('http://eds/tickets/userTickets.php', {
            method: 'POST',
            body: JSON.stringify({ patient: name }),
        })
        .then(response => response.json())
        .then(json => setTickets(json.data))
    }

    useEffect(() => {
        if(window.localStorage.getItem('role') === 'patient'){
            getUserTickets();
        } else {
            getAllTickets();
        }

    }, []);

    return (
        <div className="profile-root">
            <h2 className='profile-header'>Личный кабинет</h2>
            <UserCard className='user-card' name={name} role={role} />
            <h2 className='numbers-header'>Ваши номерки</h2>
            <div style={{ color: 'rgba(0, 0, 0, 0.5)' }}>
                {(!tickets || tickets === undefined) && (<div>Номерки не найдены</div>)}
                {window.localStorage.getItem('role') === 'patient' && (<div className='sing-up' onClick={() => navigate('/create-ticket')}>Записаться</div>)}
            </div>
            {tickets && (<Registry tickets={tickets} />)}
        </div>
    );
}
