import React from 'react';
import NextStepImage from '../../images/next-step.svg';

export const FirstStep = ({ setStep, date, setDate, setTime }) => {


    return (
        <div className="first-root">
            <h1 className='create-ticket_header'>Выберите номерок</h1>
            <div className='ticket-date'>
                <div className="date-row">
                    <div className="1">10.10 Пн</div>
                    <div className="time-block" onClick={() => {
                        setDate('10.10.2022');
                        setTime('8:00');
                    }}>08:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('10.10.2022');
                        setTime('9:00');
                    }}>09:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('10.10.2022');
                        setTime('10:00');
                    }}>10:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('10.10.2022');
                        setTime('11:00');
                    }}>11:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('10.10.2022');
                        setTime('12:00');
                    }}>12:00</div>
                </div>
                <div className="date-row">
                    <div className="1">11.10 Вт</div>
                    <div className="time-block" onClick={() => {
                        setDate('11.10.2022');
                        setTime('8:00');
                    }}>08:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('11.10.2022');
                        setTime('9:00');
                    }}>09:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('11.10.2022');
                        setTime('10:00');
                    }}>10:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('11.10.2022');
                        setTime('11:00');
                    }}>11:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('11.10.2022');
                        setTime('12:00');
                    }}>12:00</div>
                </div>
                <div className="date-row">
                    <div className="1">12.10 Ср</div>
                    <div className="time-block" onClick={() => {
                        setDate('12.10.2022');
                        setTime('8:00');
                    }}>08:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('12.10.2022');
                        setTime('9:00');
                    }}>09:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('12.10.2022');
                        setTime('10:00');
                    }}>10:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('12.10.2022');
                        setTime('11:00');
                    }}>11:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('12.10.2022');
                        setTime('12:00');
                    }}>12:00</div>
                </div>
                <div className="date-row">
                    <div className="1">13.10 Чт</div>
                    <div className="time-block" onClick={() => {
                        setDate('13.10.2022');
                        setTime('8:00');
                    }}>08:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('13.10.2022');
                        setTime('9:00');
                    }}>09:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('13.10.2022');
                        setTime('10:00');
                    }}>10:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('13.10.2022');
                        setTime('11:00');
                    }}>11:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('13.10.2022');
                        setTime('12:00');
                    }}>12:00</div>
                </div>
                <div className="date-row">
                    <div className="1">14.10 Пт</div>
                    <div className="time-block" onClick={() => {
                        setDate('14.10.2022');
                        setTime('8:00');
                    }}>08:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('14.10.2022');
                        setTime('9:00');
                    }}>09:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('14.10.2022');
                        setTime('10:00');
                    }}>10:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('14.10.2022');
                        setTime('11:00');
                    }}>11:00</div>
                    <div className="time-block" onClick={() => {
                        setDate('14.10.2022');
                        setTime('12:00');
                    }}>12:00</div>
                </div>
            </div>
            <div className="next-step" onClick={() => {
                if (date !== '') {
                    setStep(2);
                } else {
                    alert('Выберите дату записи');
                }
            }}>
                Перейти на следующий шаг
                <img className='next-step_image' src={NextStepImage} alt="next-step" />
            </div>
        </div>
    );
}
