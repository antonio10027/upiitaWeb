<%@ page import="java.sql.*" %>

       <%
	   
String driver = "org.postgresql.Driver";
String url = "jdbc:postgresql://127.0.0.1:5433/covid";
String username = "postgres";
String password = "74272200";
Connection myConnection = null;
PreparedStatement myPreparedStatement = null;
ResultSet myResultSet = null;
Class.forName(driver).newInstance();
myConnection = DriverManager.getConnection(url,username,password);
Statement st;
ResultSet rs;
st = myConnection.createStatement();

/*SELECT MAX(suma)as maximo FROM (SELECT SUM(daily_cases) as suma FROM world_covid_data 
where date >= '20200501' and date <= '20210501'
GROUP BY country)z *7
         String query  = "Select Max(sum) From(SELECT SUM(daily_"+request.getParameter("parameter")+") as sum FROM world_covid_data where date >= '"+request.getParameter("date1")+"' AND date <= '"+request.getParameter("date2")+"' GROUP BY country_name) z";

          rs = st.executeQuery(query) ;
		ResultSetMetaData  meta = rs.getMetaData();
Integer columncount = meta.getColumnCount();
       %>
{"maximum":[
      <% while(rs.next()){ %>
	 {
  <% for (int i = 1 ; i<=columncount; i++)
{
%>
 <% if (i>1){%>,<% } %>
"<%= meta.getColumnName(i)%>":"<%= rs.getString(meta.getColumnName(i))%>"
    <% } %>
	  }
	  <% if (!rs.isLast()){%>,<% } %>
	   <% } %>
	  ]}
	 
