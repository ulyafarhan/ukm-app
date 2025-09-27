export default function InputLabel({ value, className = '', children, ...props }) {
    return (
        <label
            {...props}
            className={
                `block text-sm font-semibold tracking-wide text-gray-700 
                 transition-all duration-300 ease-in-out 
                 group-focus-within:text-indigo-600 
                 group-hover:text-indigo-500
                 ` + className
            }
        >
            {value ? value : children}
        </label>
    );
}