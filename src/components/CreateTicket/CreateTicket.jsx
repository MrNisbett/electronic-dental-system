import './CreateTicket.css';
import React, { useEffect, useState } from "react";
import { FirstStep } from "./FirstStep";
import { SecondStep } from './SecondStep';
import ProfileImage from '../../images/profile.svg';
import { useNavigate } from 'react-router-dom';
import { Ticket } from './Ticket';

export const CreateTicket = () => {
    const [step, setStep] = useState(1);
    const [time, setTime] = useState('');
    const [date, setDate] = useState('');
    const [doctor, setDoctor] = useState('');

    const handleChange = (s) => {
        setDoctor(s);
    }

    const navigate = useNavigate();

    return (
        <>
            <div className='profile-link' onClick={() => navigate('/')}>
                <img src={ProfileImage} alt="profile" />
                <span>Личный кабинет</span>
            </div>
            {step === 1 && ( <FirstStep setStep={setStep} date={date} setDate={setDate} time={time} setTime={setTime} /> )}
            {step === 2 && ( <SecondStep setStep={setStep} doctor={doctor} setDoctor={handleChange} /> )}
            {step === 3 && ( <Ticket setStep={setStep} doctor={doctor} time={time} date={date} /> )}

        </>
    );
}
