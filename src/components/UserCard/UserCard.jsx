import './UserCard.css';
import React from 'react';
import ProfileImage from '../../images/profile.svg';

export const UserCard = ({name, role, className, onClick}) => {

    return (
        <div className={`user-card-root ${className || ''}`} onClick={onClick}>
            <img className='image' src={ProfileImage} alt="profile" />
            <div className='user-card_text'>
                <div className='user-name'>{name || 'Любой врач'}</div>
                {role && ( <div className='user-role'>{role}</div> )}
            </div>
        </div>
    );
}