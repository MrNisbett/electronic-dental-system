import './Registry.css';
import React from 'react';

export const Registry = ({ tickets }) => {

    const userRole = window.localStorage.getItem('role');

    const dates = [
        '10.10, пн',
        '11.10, вт',
        '12.10, ср',
        '13.10, чт',
        '14.10, пт',
        '17.10, пн',
        '18.10, вт'
    ];

    const times = [
        '8:00',
        '9:00',
        '10:00',
        '11:00',
        '12:00'
    ];

    const getGridCol = (val) => {
        switch (val) {
            case '10.10.2022':
                return 1;
            case '11.10.2022':
                return 2;
            case '12.10.2022':
                return 3;
            case '13.10.2022':
                return 4;
            case '14.10.2022':
                return 5;
            case '17.10.2022':
                return 6;
            case '18.10.2022':
                return 7;
            default:
                return 1;
        }
    }

    const getGridRow = (val) => {
        switch (val) {
            case '8:00':
                return 1;
            case '9:00':
                return 2;
            case '10:00':
                return 3;
            case '11:00':
                return 4;
            case '12:00':
                return 5;
            default:
                return 1;
        }
    }
    
    return (
        <div className="registry-root">
            <div className="calendar-container">
                <div className="calendar-header">
                    <ul className="daynumbers">
                        {Array.from(dates, (date, index) => (
                            <li key={index}>{ date }</li>
                        ))}
                    </ul>
                </div>
                <div className="time-container">
                    <ul className="time">
                        {Array.from(times, (time, index) => (
                            <li key={index}>{ time }</li>
                        ))}
                    </ul>
                </div> 
                {userRole === 'patient' ? (
                    <div className="event-container">
                    {Array.from(tickets, (ticket, index) => (
                        <div key={index} className='event-slot' style={{ gridColumn: getGridCol(ticket.date), gridRow: getGridRow(ticket.time) }}>
                            <div className='event-status'>
                                <b>Пациент:</b>{' ' + ticket.patient}<br /><b>Врач:</b>{' ' + ticket.doctor}
                            </div>
                        </div>
                    ))}
                </div>
                ) : (
                    <div className="event-container">
                    {Array.from(tickets, (ticket, index) => (
                        <div key={index} className='event-slot' style={{ gridColumn: getGridCol(ticket.date), gridRow: getGridRow(ticket.time) }}>
                            <div className='event-status'>
                                <b>Пациент:</b>{' ' + ticket.patient}
                            </div>
                        </div>
                    ))}
                </div>
                )}         
                
            </div>
        </div>
    );
}