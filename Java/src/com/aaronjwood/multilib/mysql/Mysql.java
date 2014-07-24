package com.aaronjwood.multilib.mysql;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;

public class Mysql {

    private Connection connection;
    private String host;
    private int port = 3306;
    private String username;
    private String password;
    private String db;

    /**
     * Sets necessary information to connect to a database
     *
     * @param host The MySQL host
     * @param username The username to access the database
     * @param password The password to access the database
     * @param db The database to work with
     */
    public Mysql(String host, String username, String password, String db) {
        this.host = host;
        this.username = username;
        this.password = password;
        this.db = db;
    }

    /**
     * Sets necessary information including the port to connect to a database
     *
     * @param host The MySQL host
     * @param port The port MySQL is running on
     * @param username The username to access the database
     * @param password The password to access the database
     * @param db The database to work with
     */
    public Mysql(String host, int port, String username, String password, String db) {
        this(host, username, password, db);
        this.port = port;
    }

    /**
     * Connects to the database using the information set in the constructor
     *
     * @throws SQLException
     */
    public void connect() throws SQLException {
        this.connection = DriverManager.getConnection("jdbc:mysql://" + host + ":" + port + "/" + this.db, this.username, this.password);
    }

    /**
     * Runs a select query against the database and returns the results
     *
     * @param sql The SQL query to be executed
     * @return The set of results
     * @throws SQLException
     */
    public ResultSet query(String sql) throws SQLException {
        Statement statement = connection.createStatement();
        ResultSet results = statement.executeQuery(sql);
        return results;
    }

    /**
     * Runs an UPDATE, INSERT, DELETE, or DROP query against the database and
     * returns the affected rows
     *
     * @param sql The SQL query to be executed
     * @return The number of affected rows
     * @throws SQLException
     */
    public int queryUpdate(String sql) throws SQLException {
        Statement statement = connection.createStatement();
        int affectedRows = statement.executeUpdate(sql);
        return affectedRows;
    }

}
