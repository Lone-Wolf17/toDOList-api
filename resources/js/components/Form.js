import React, {useState} from 'react';
import axios from 'axios';

export default function Form () {

    const [title, setTitle] = useState('');

    const handleOnChange = (e) => {
        setTitle(e.target.value);
    }

    const createTodo = () => {

        const todo = {
            title: title,
        }


        axios.post('http://localhost:8000/api/todos/', todo)
            .then(res => {
                window.location.reload(false);
                console.log(res.data)
            })
            .catch((error) => {
                console.log(error)
            });

    }


    return (
        <div className='App'>
            <input type='text' onChange={handleOnChange}/>
            <button onClick={createTodo}>Add todo</button>
        </div>
    );
}



