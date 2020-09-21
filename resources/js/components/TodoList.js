import React, {useEffect, useState} from 'react';
import axios from 'axios';

import Todo from "./Todo";

export default function TodoList () {

    const [todoList, setTodoList] = useState('');


    useEffect(() => {
        axios.get('http://localhost:8000/api/todos/')
            .then(res => {
                const todoList = res.data;
                setTodoList(todoList);
                console.log(todoList);
                console.log(typeof todoList);
            });
    }, []);

    function todoItemDeleted (index) {
        const newTodoList = todoList;
        console.log(index)
        newTodoList.splice(index, 1);
        setTodoList(newTodoList);
    }

    return (
        <div>
            <h1>Todo List</h1>

            {
                todoList ? todoList.map((todo, index) => (
                    <Todo todo={todo} index = {index} onTodoDeleted={todoItemDeleted}  key={index} />
                )) : 'loading'
            }
        </div>
    );

}
