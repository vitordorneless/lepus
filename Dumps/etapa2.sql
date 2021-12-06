SELECT b.dept_name AS departamento, concat(c.first_name,' ',c.last_name) AS nome_funcionario,datediff(a.to_date,a.from_date) AS dias_trabalhados 
	FROM dept_emp a
		INNER JOIN departments b ON a.dept_no = b.dept_no
		INNER JOIN employees c ON a.emp_no = c.emp_no
			WHERE a.to_date IS NOT NULL
				GROUP BY b.dept_name
					ORDER BY dias_trabalhados DESC, b.dept_name ASC, nome_funcionario ASC
						LIMIT 10;


