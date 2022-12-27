import React from 'react';
import { useNavigate } from 'react-router-dom';
import Close from '../../images/close.svg';

export const Ticket = ({ setStep, doctor, time, date }) => {

    const navigate = useNavigate();

    const user = window.localStorage.getItem('secondName') + ' ' + window.localStorage.getItem('firstName');

    const createTicket = () => {
        const data = {
            patient: user,
            doctor,
            time,
            date,
        };
        fetch('http://eds/tickets/create.php', {
            headers: {
                'Content-Type': 'application/json',
                "Access-Control-Allow-Methods": "POST",
                'Access-Control-Allow-Headers': 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'
            },
            method: 'POST',
            body: JSON.stringify(data)
        }).then(() => navigate('/'));
    }

    return (
        <div className="ticket-root">
            <div className='ticket-close' onClick={() => setStep(1)}>
                <img src={Close} alt="close" />
            </div>
            <div className='ticket-body'>
                ФИО: <br />
                {user}<br /><br /><br />
                Ваш врач: <br />
                {doctor || 'Загребина Марина'}<br /><br /><br />
                Дата: {date && time && (date + ' ' + time) || '10.10.2022 8:00'}
            </div>

            <div className='ticket-button' onClick={() => createTicket()}>Подтвердить</div>
        </div>
    );
}