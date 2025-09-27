import { motion } from "framer-motion";

export default function PrimaryButton({ children, className = '', ...props }) {
    return (
        <motion.button
            whileTap={{ scale: 0.95 }}
            whileHover={{ scale: 1.05 }}
            transition={{ type: "spring", stiffness: 300 }}
            className={
                `relative overflow-hidden px-6 py-3 rounded-lg 
                 bg-indigo-600 text-white font-semibold shadow-md
                 hover:bg-indigo-700 focus:outline-none
                 transition-all duration-300 ` + className
            }
            {...props}
        >
            {children}
            {/* Ripple effect */}
            <span className="absolute inset-0 bg-white/20 opacity-0 hover:opacity-100 transition-opacity duration-300" />
        </motion.button>
    );
}