import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import Form from "./Form";
import TodoList from "./TodoList";

function TodoApp() {


    return (
        <div className='App'>
            <h1>Todo</h1>
            <Form />
            <TodoList />

        </div>
    );
}

export default TodoApp;

// Dom Element
if (document.getElementById('todoApp')) {
    ReactDOM.render(<TodoApp />, document.getElementById('todoApp'));
}

