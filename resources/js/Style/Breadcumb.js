export const breadcumbStyle = {
    paper:{
        backgroundColor: 'inherit',
        color: 'white',
        marginBottom: '25px',
        display: 'flex',
        justifyContent: 'flex-end',
        alignItems: 'center',
        marginTop: '-20px'
    },
    link :{
        color: '#78909C',
        textDecoration: 'none',
        display: 'flex',
        alignItems: 'center',
        fontFamily: 'Roboto',
        fontSize: '14px',
        '&:hover' : {
            color: '#555555',
        }
    },
    activelink:{
        color: '#555555', fontFamily: 'Roboto', fontSize: '14px'
    },
    icon :{
        marginRight: '8px',
        fontSize: '16px',
        textDecoration: 'none',
    }
}