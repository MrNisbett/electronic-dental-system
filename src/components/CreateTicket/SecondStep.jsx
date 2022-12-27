import React, { useEffect } from "react";
import { UserCard } from "../UserCard/UserCard";
import NextStepImage from '../../images/next-step.svg';

export const SecondStep = ({ setStep, setDoctor }) => {

    return (
        <div className="second-root">
            <h1 className='create-ticket_header'>Выберите стоматолога</h1>
            <div className='any-doctor'>
                <UserCard />
            </div>
            <div className="select-doctor">
                <div className="doctor-row">
                    <UserCard name='Марина Загребина' role='стоматолог-терапевт' className='doctor' onClick={() => setDoctor('Марина Загребина')} />
                    <UserCard name='Марина Загребина' role='стоматолог-терапевт' className='doctor' onClick={() => setDoctor('Марина Загребина')} />
                    <UserCard name='Марина Загребина' role='стоматолог-терапевт' className='doctor' onClick={() => setDoctor('Марина Загребина')} />
                </div>
                <div className="doctor-row">
                    <UserCard name='Марина Загребина' role='стоматолог-терапевт' className='doctor' onClick={() => setDoctor('Марина Загребина')} />
                    <UserCard name='Марина Загребина' role='стоматолог-терапевт' className='doctor' onClick={() => setDoctor('Марина Загребина')} />
                    <UserCard name='Марина Загребина' role='стоматолог-терапевт' className='doctor' onClick={() => setDoctor('Марина Загребина')} />
                </div>
            </div>
            <div className="next-step" onClick={() => setStep(3)}>
                Перейти на следующий шаг
                <img className='next-step_image' src={NextStepImage} alt="next-step" />
            </div>
        </div>
    );
}