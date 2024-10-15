import styles from "./index.module.scss";

type InputProps = {
  value: number;
  onChange: (e: React.FormEvent<HTMLInputElement>) => void;
};

export const Input = ({ value, onChange }: InputProps) => {
  return (
    <input
      onChange={onChange}
      className={styles.root}
      type="number"
      defaultValue={value}
    />
  );
};
