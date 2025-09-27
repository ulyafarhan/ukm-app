import { forwardRef, useEffect, useRef } from 'react';

export default forwardRef(function TextInput(
    { type = 'text', className = '', isFocused = false, ...props },
    ref
) {
    const input = ref ? ref : useRef();

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <input
            {...props}
            type={type}
            ref={input}
            className={
                `
                w-full px-4 py-2 rounded-lg border border-gray-300 
                bg-white placeholder-gray-400
                focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400
                transition-all duration-300 ease-in-out
                hover:shadow-md
                ` + className
            }
        />
    );
});