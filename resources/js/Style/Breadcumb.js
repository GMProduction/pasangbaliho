import Button from '@material-ui/core/Button';
import { NavLink } from 'react-router-dom';
import React from 'react';

export const breadcumbStyle = {
    paper:{
        backgroundColor: 'inherit',
        color: 'white',
        marginBottom: '25px',
        display: 'flex',
        justifyContent: 'flex-end',
        alignItems: 'center'
        
    },
    link :{
        color: '#78909C',
        textDecoration: 'none',
        display: 'flex',
        alignItems: 'center',
        fontFamily: 'Roboto Light',
        fontSize: '14px',
        '&:hover' : {
            color: '#555555',
        }
    },
    icon :{
        marginRight: '8px',
        fontSize: '16px',
        textDecoration: 'none',
    }
}