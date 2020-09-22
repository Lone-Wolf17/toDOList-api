import React, {useState} from 'react';
import axios from 'axios';

export default function Form () {

    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');

    const handleOnTitleChange = (e) => {
        setTitle(e.target.value);
    }

    const handleOnDescriptionChange = (e) => {
        setDescription(e.target.value);
    }

    const createTodo = () => {

        const todo = {
            title: title,
            description: description
        }

        console.log(todo);


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
            <label htmlFor='title'>Title</label><br/>
            <input type='text' onChange={handleOnTitleChange} id='title' className='myText' required/><br/>
            <label htmlFor='description'>Description</label><br/>
            <input type='textarea' onChange={handleOnDescriptionChange} id='description' className='myText txtBox'/>
            <br/>
            <button onClick={createTodo}>Add todo</button>
        </div>
    );

}

